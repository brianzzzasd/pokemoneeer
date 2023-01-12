# Pokemoneeer

### Techs Used:
- Laravel
- Laravel Sanctum
- Vite
- Vue3 Composition & Options API
- TailwindCSS
- HeadlessUI
- Pinia

### Presinstalls
- Should have Vite and NPM/PNPM installed in the machine.

After Cloning: 

### Backend Setup

```bash
cd pokemon-test/backend
cp .env.example .env

composer install 

php artisan migrate:fresh && php artisan key:generate && php artisan serve

php artisan pokemon:fill // to fill pokemons table or you can use the db inside /backend. (pokemon.sql)
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
