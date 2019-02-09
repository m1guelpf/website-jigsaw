import parse from 'querystring'

exports.handler = (event, context, callback) => {
    if (event.httpMethod !== 'POST') { 
        callback(null, {
            statusCode: 301,
            headers: {
                Location: 'https://miguelpiedrafita.com'
            },
            body: null
        })
    }

    console.log(parse(event.body))

    callback(null, {
        statusCode: 301,
        headers: {
            Location: 'https://miguelpiedrafita.com/subscribed'
        },
        body: null
    });
}