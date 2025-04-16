# Shirtigo
This is a test project done for Shirtigo.

## Important Notes
1. `Inertia` is used to get the products. Axios is also used to show the full potential of the developer. `Inertia` is combined with normal axios based requests.
    - For `simplicity`, laravel `api middleware` is `NOT` used here. Instead the routes are defined in `web.php`. In the task description, there was no mention of using it or not.
2. `Vue 3` is used for frontend.
3. `mysql` was used only for the basic migrations, `QUEUE_CONNECTION`, `SESSION_DRIVER` & `CACHE_STORE`. You can change database settings based on your own configuration.
4. `TypeScript` is not used but it would've been possible.
5. This repo is not in production mode (DEBUGGING is enabled).
6. Different coding techniques and libs have been used in this implementation 
    - Used `InertiaJS` simply in `web.php` without independant internal API
    - Handled retrieved data from the internal API in the client side to aviod overwhelming the Laravel server and the third party API (Shirtigo Cockpit API). Only necessary API requests are made.
    - There are places where simple forms of coding is used and places where highly structured coding is evident to demonstrate the full potential of the developer.
    - Vue Layouts were not used as it was not necessary in this specific implementation.
7. The calculation of the Offsets and the width might not be precise and it is purly based on the understanding of the response of the data from `Shirtigo Cockpit API`. No explanation was provided.
8. Any fixed data was allowed by the examiner. (e.g. the design picture)