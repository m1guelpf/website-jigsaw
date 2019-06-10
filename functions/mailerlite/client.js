import request from 'request-promise';

const makeRequest = (method, path, body, parameters) => {
    return request({
        method: method,
        url: `https://api.mailerlite.com/api/v2/${path}`,
        headers: {
            'User-Agent': 'ghostletter',
            'X-MailerLite-ApiKey': process.env.MAILERLITE_API_KEY,
            'Content-Type': 'application/json',
        },
        qs: parameters,
        body: body,
        json: true
    })
}

const Get = (path, parameters) => {
    return makeRequest('GET', path, {}, parameters)
}

const Post = (path, body) => {
    return makeRequest('POST', path, body)
}

const Put = (path, body) => {
    return makeRequest('PUT', path, body)
}

const Delete = path => {
    return makeRequest('DELETE', path)
}

/* Export the submodule. */
export {
    Get,
    Post,
    Put,
    Delete
}