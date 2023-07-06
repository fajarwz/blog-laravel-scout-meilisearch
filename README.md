# Simple and Advanced Search With Laravel Scout and Meilisearch
This is an implementation of Laravel Scout-Meilisearch in Laravel. A blog about this can be found here: [Simple and Advanced Search With Laravel Scout and Meilisearch | Fajarwz](https://fajarwz.com/blog/simple-and-advanced-search-with-laravel-scout-and-meilisearch/).

## Installation

### Composer Packages 
```
composer install
```

## Configuration

### Create `.env` file from `.env.example`
```
cp .env.example .env
```

### Generate Laravel App Key
```
php artisan key:generate
```

### Database Integration
1. Create a database and connect it with Laravel with filling the DB name in `DB_DATABASE`
2. Adjust `DB_USERNAME`
3. Adjut `DB_PASSWORD`

### Migrate the Database Migration and Run the Seeder
```
php artisan migrate --seed
```

## Run App
```
php artisan serve
```

## Meilisearch Installation

Download the Meilisearch app

```
# Install Meilisearch
curl -L https://install.meilisearch.com | sh

# Launch Meilisearch without key
./meilisearch
# Or
meilisearch

# Launch Meilisearch with key in the .env.example
meilisearch --master-key joVaZyaMWrqrO8OXEyTPxpvE8kY_gjLf6FTq1t9chR8
```

## Import Initial Post Data

```
php artisan scout:import "App\Models\Post"
```

## Making Sure Scout Settings Updated

```
php artisan scout:sync-index-settings
```

## Search Example 

Request:

```
GET http://localhost:8000/api/search?query=dolor&order_by=category_id,desc
```

Response:

```
{
    "data": {
        "current_page": 1,
        "data": [
            {
                "id": 238,
                "title": "Voluptatibus voluptate ea ipsam.",
                "slug": "voluptatibus-voluptate-ea-ipsam",
                "content": "Rem et optio voluptas omnis aspernatur. Reiciendis debitis ea recusandae dolorem ad saepe. Voluptates et possimus animi at. Corporis a sit ipsum amet eius laudantium. Omnis sunt atque perspiciatis in et qui.",
                "published": 1,
                "category_id": 3,
                "created_at": "2023-07-06T02:55:05.000000Z",
                "updated_at": "2023-07-06T02:55:05.000000Z",
                "category": {
                    "id": 3,
                    "name": "error",
                    "slug": "error",
                    "created_at": "2023-07-06T02:55:04.000000Z",
                    "updated_at": "2023-07-06T02:55:04.000000Z"
                }
            },
            // ...
    },
    "status": 200
}
```

## Create New Post Example

Request:

```
POST http://localhost:8000/api/posts
data: 
{
    "title": "zulfikar",
    "content": "zulfikar is a software engineer",
    "published": 1,
    "category_id": 7
}
```

Response:

```
{
    "data": {
        "title": "zulfikar",
        "slug": "zulfikar-1688607259",
        "content": "zulfikar is a software engineer",
        "published": 1,
        "category_id": 7,
        "updated_at": "2023-07-06T01:34:19.000000Z",
        "created_at": "2023-07-06T01:34:19.000000Z",
        "id": 1011
    },
    "status": 200
}
```