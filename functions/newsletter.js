import atob from 'atob'

exports.handler = (event, context, callback) => {
    const body = event.isBase64Encoded ? atob(event.body) : event.body

    console.log(body)

    callback(null, {
        statusCode: 200,
        body: "OK"
    });
}