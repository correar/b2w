# Project b2w

## Requirements

* Laravel
* Mongodb
* Docker

Clone Project and use docker compose command
```

docker-compose up
```
## Access Software

```

http://localhost
```

## API Methods


|  URL               | Method |  Function                              |
| ------------------ | ------ | -------------------------------------- |
| api/planet         |  GET   | List all planets                       |
| api/planet/<id>    |  GET   | Show planet information get by Id      |
| api/planet/<name>  |  GET   | Show planet information get by Name    |
| api/planet/        |  POST  | Create new Planet                      |
| api/planet/<id>    | DELETE | Delete Planet by Id                    |
