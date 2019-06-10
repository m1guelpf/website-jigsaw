import querystring from 'querystring'
import mailerlite from './mailerlite'

require('dotenv').load();

exports.handler = async (event, context, callback) => {
    if (event.httpMethod !== 'POST') { 
        return callback(null, {
            statusCode: 301,
            headers: {
                Location: 'https://miguelpiedrafita.com'
            },
            body: '',
        })
    }

    const body = querystring.parse(new Buffer(event.body, 'base64').toString('ascii'))

    await mailerlite.subscribeUser(body.email)

    callback(null, {
        statusCode: 301,
        headers: {
            Location: 'https://miguelpiedrafita.com/subscribed'
        },
        body: 'Done!'
    });
}