# Pokemoneeer

After Cloning: 

### Backend Setup

```bash
cd pokemon-test/backend
cp .env.example .env

php artisan migrate:fresh && php artisan key:generate && php artisan serve
```
Database name: <b>pokemoneeer</b> (or whatever you want, just update the .env database name)

### Frontend Setup

```bash
cd ../frontend

pnpm i && pnpm run dev
```
or if you don't have pnpm you can:

```bash
npm i && npm run dev
```
