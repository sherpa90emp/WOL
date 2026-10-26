# Deploy WOL su Raspberry Pi

## Sul server di sviluppo (build)
1. Controllare l'architettura del Pi: `uname -m` (aarch64 = arm64)
2. Build per il Pi ed export:
   docker buildx build --platform linux/arm64 -t wol-app:latest --load .
   docker save wol-app:latest | gzip > wol-app.tar.gz
3. Copiare i file sul Pi:
   ssh pi@<ip-pi> mkdir -p ~/wol
   scp wol-app.tar.gz .env docker-compose.prod.yml pi@<ip-pi>:~/wol/

## Sul Pi (avvio)
cd ~/wol
chmod 600 .env
docker load < wol-app.tar.gz
docker compose -f docker-compose.prod.yml up -d

## Contenuto della cartella ~/wol
- docker-compose.prod.yml  (image: wol-app:latest, env_file: .env, network_mode: host)
- .env                     (MAC, broadcast, password: mai nell'immagine né su git)
- wol-app.tar.gz           (serve solo per il docker load)

## Verifiche
docker compose -f docker-compose.prod.yml ps
docker compose -f docker-compose.prod.yml logs --tail 20
Apri: http://<ip-pi>:8085/

## Aggiornare l'app
1. Rifare build + save sul server
2. Copiare solo wol-app.tar.gz sul Pi
3. docker load < wol-app.tar.gz
4. docker compose -f docker-compose.prod.yml up -d --force-recreate

## Cambiare il .env
nano .env
docker compose -f docker-compose.prod.yml up -d --force-recreate

## Promemoria rete
- Tailscale installato sul Pi (non nel container)
- IP fisso al Pi dal router