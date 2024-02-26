
db.createUser({
    user: 'root',
    pwd: 'uwu',
    roles: [
        {
            role: 'readWrite',
            db: 'tienda-laravel',
        },
    ],
})

db = db.getSiblingDB('tienda-laravel')

