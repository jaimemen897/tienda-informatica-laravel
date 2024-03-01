
db = connect("mongodb://localhost:27017/tienda-laravel");

db.createUser({
    user: 'root',
    pwd: 'uwuu',
    roles: [
        {
            role: 'readWrite',
            db: 'tienda-laravel',
        },
    ],
});

db = connect("mongodb://localhost:27017/tienda-testing");

db.createUser({
    user: 'test',
    pwd: 'uwuu',
    roles: [
        {
            role: 'readWrite',
            db: 'tienda-testing',
        },
    ],
});
