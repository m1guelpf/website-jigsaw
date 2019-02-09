import querystring from 'querystring'
import mailerlite from './mailerlite'

require('dotenv').load();

exports.handler = async (event, context, callback) => {
    if (event.httpMethod !== 'POST') { 
        callback(null, {
            statusCode: 301,
            headers: {
                Location: 'https://miguelpiedrafita.com'
            },
            body: null
        })
    }

    const body = querystring.parse(event.body)

    await mailerlite.subscribeUser(body.email)

    callback(null, {
        statusCode: 301,
        headers: {
            Location: 'https://miguelpiedrafita.com/subscribed'
        },
        body: null
    });
}