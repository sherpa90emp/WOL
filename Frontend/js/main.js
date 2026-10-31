async function wol() {

    const url = '/api/wol'

    const options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
    }

    try {
        const response = await fetch(url, options)

        if (!response.ok) {
            new Error(`Stato: ${response.status}`)
        }

        const testoRisposta = await response.json()

        console.log(testoRisposta)
    } catch (error) {
        console.error(error.message)
    }
}

async function status(){
    const url = '/api/status'

    const options = {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
        },
    }

    try {
        const response = await fetch(url, options)

        if (!response.ok) {
            new Error(`Stato: ${response.status}`)
        }

        const testoRisposta = await response.json()
        console.log(testoRisposta)
    } catch (error) {
        console.error(error.message)
    }
}