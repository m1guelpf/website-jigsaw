import atob from 'atob'

exports.handler = (event, context, callback) => {
    const body = event.isBase64Encoded ? JSON.parse(atob(event.body)) : JSON.parse(event.body)

    console.log(body.email)

    callback(null, {
        statusCode: 200,
        body: "OK"
    });
}