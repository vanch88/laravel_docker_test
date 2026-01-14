# Laravel Docker Test

## Оглавление

- [Сборка и запуск](#сборка-и-запуск)
- [API](#api)
  - [Продукты](#продукты)
  - [Сделки](#сделки)

## Сборка и запуск

```bash
cp .env.example .env
docker compose up --build
```

## API

Базовый URL: `http://localhost:8080`

### Продукты

#### 1. Создание продукта (так же написан остальной crud, но он тут не указан в рамках задачи)

**POST** `/products`

```bash
curl -X POST http://localhost:8080/products \
  -H "Content-Type: application/json" \
  -d '{"name": "Название продукта"}'
```

### Сделки

#### 1. Создание сделки

**POST** `/deals`

```bash
curl -X POST http://localhost:8080/deals \
  -H "Content-Type: application/json" \
  -d '{
    "product_id": 1,
    "client_name": "Иван Иванов",
    "client_phone": "+79991234567",
    "comment": "Комментарий к сделке",
    "status": "new"
  }'
```

#### 2. Получение списка сделок по продукту

**GET** `/deals?product_id={id}`

```bash
curl -X GET "http://localhost:8080/deals?product_id=1"
```

#### 3. Получение сделки по ID

**GET** `/deals/{id}`

```bash
curl -X GET http://localhost:8080/deals/1
```

#### 4. Обновление сделки

**PUT/PATCH** `/deals/{id}`

```bash
curl -X PUT http://localhost:8080/deals/1 \
  -H "Content-Type: application/json" \
  -d '{
    "status": "completed",
    "comment": "Обновленный комментарий"
  }'
```

#### 5. Удаление сделки

**DELETE** `/deals/{id}`

```bash
curl -X DELETE http://localhost:8080/deals/1
```
