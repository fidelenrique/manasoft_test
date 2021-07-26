## API rest
- LIST EQUIPMENTS : GET http://localhost/api/equipments
- DELETE A EQUIPMENT : DELETE http://localhost/api/equipment/{id}
- SHOW A EQUIPMENT : GET http://localhost/api/equipment/{id}
- ADD A EQUIPMENT : POST http://localhost/api/equipments

IN:
```
{
    "name":"test nom de l'équipement 5",
    "category":"tesst catégorie de l'éauipement 5",
    "number":12345
}
```
OUT:
```
{
    "id": 5,
    "name": "test nom de l'équipement 5",
    "category": "tesst catégorie de l'éauipement 5",
    "number": 12345,
    "createdAt": {
        "date": "2021-07-21 09:31:19.546088",
        "timezone_type": 3,
        "timezone": "UTC"
    }
}
```

- UPDATE A EQUIPMENT : PUT http://localhost/api/equipment/{id}

IN :
```
{
    "name":"hello nom de l'équipement 3"
}
```

OUT :
```
{
    "name": "hello nom de l'équipement 3",
    "category": "tesst catégorie de l'éauipement",
    "number": 123,
    "createdAt": {
        "date": "2021-07-19 02:43:44.000000",
        "timezone_type": 3,
        "timezone": "UTC"
    },
    "updatedAt": null
}
```

- Installing Encore in Symfony Applications
  https://symfony.com/doc/current/frontend/encore/installation.html
  
