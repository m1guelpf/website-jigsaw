const client = require('./client')

const subscribeUser = email => {
    const group = process.env.MAILERLITE_GROUP
    return client.Post(`groups/${group}/subscribers`, {
        email: email
    }).then(() => {
        console.log(`Subscribed ${email} to the list`)
    })
}

const unsubscribeUser = email => {
    return client.Put(`subscribers/${email}`, {
        type: 'unsubscribed'
    }).then(() => {
        console.log(`Unsubscribed ${email} from the list`)
    })
}

export {
    subscribeUser,
    unsubscribeUser
}