document.addEventListener('DOMContentLoaded', function ()
{
    setTimeout(function (){
        void status()
    }, 2000)
})


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

    setTimeout(function ()
    {
      status();
    }, 5000)
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

        if (testoRisposta[0].up) {
            let status = document.querySelector('#status')
            status.classList.remove('spinner-border', 'fg-primary')
            status.classList.add('spinner-grow', 'text-success')
        }
        else
        {
            let status = document.querySelector('#status')
            status.classList.remove('spinner-border', 'fg-primary')
            status.classList.add('spinner-grow', 'text-danger')
        }

        console.log(
            ' Code: ' + (testoRisposta[0].code) + '\n',
            'Server is up: ' + testoRisposta[0].up + '\n',
            'Status: ' + testoRisposta[0].status,
        )
    } catch (error) {
        console.error(error.message)
    }
}