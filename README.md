### Questions
Discussion questions for BookSpot.

## What could be improved?
In my opinion there are a few things that could be improved opon.
- First of all, the application is not secured behind any session or token validation, making it open towards all users. For this, I would implement some type of token validation after login or use a session to keep the application secure.
- Second, as I am not too used to the framework, there are bound to be easier ways to create usable models. I would research better ways to make the code more consize and along with the language and framework standards. This would make the code more readable for people more used to the framework.
- Third, Results. In the code, the database calls are handled with try-catch blocks. These are very good to catch all possible errors. The problem with them on the other hand is that there is a possibity for them to catch alot of different errors in the same block. This could make it harder to know what caused the bug. I would try to replace try-catch blocks with Results (inspired from Rust). Instead of throwing an error if something fails, it simply returns a Result, which is an enum, containing the Error, which then can be used to handled in a specific way, making it easier to know what caused the bug. If the Result is not an error, then it would simply contain a "Success" or "Ok" enum which contains the Result value.
- variable name convention, there seem to be somekind of mismatch in variable name convension. PHP usually uses snake_case where as laravel seem to use camelCase. I would choose one to keep consistancy thoughout the codebase.

## How would you make sure each user only has access to its own addresses
As listed before, I would firstly implement security for the api using middlewares and such. After that would be completed, I would simply make some kind of check using said middleware if the user is allowed to gather the wanted information. If not, the middleware would return a 401, else it would go on to the next() function, which then would be the rest of the route.

## A new model, company, is added. Companies can also have addresses - how would you tackle this problem?
The tackling here would be very simple and straight forward. There are two ways I would implement this.
- By adding a new help tabel in the database, company_addresses, identical to the user_addresses table which already exists.
- By changing the users_addresses table to be more generic, either so that it could contain a column for company_id, or to just rename the user_id column to something more generic like "relation_id"

## Multitenancy: what if there are multiple shops using our app, and each shop has its own sets of users. Can you list a few of the problems that has to be solved.
- Allow for many shops: Make a shop have its own "shop_id" to make it possible for many different shops
- Make shops unique: Make relations on every table so that it would contain the source shop.
- Create specific user relations: Make users have a relation to a certain shop or shops.
- Allow user heirarchy: Make different shop user levels to allow admins of each shop to make their own heirarchy.

