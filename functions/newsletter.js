const querystring = require('querystring');
const { subscribeUser } = require ('./mailerlite');

require('dotenv').load();

export async function handler(event, context, callback) {
    if (event.httpMethod !== 'POST') { 
        callback(null, {
            statusCode: 301,
            headers: {
                Location: 'https://miguelpiedrafita.com'
            },
            body: '',
        })
    }

    const body = querystring.parse(new Buffer(event.body, 'base64').toString('ascii'))

    await subscribeUser(body.email)

    callback(null, {
        statusCode: 301,
        headers: {
            Location: 'https://miguelpiedrafita.com/subscribed'
        },
        body: 'Done!'
    });
}