# Online store with tabletop games
Simple shop website and my first web development project.
As User u can:
- search, view, filter products,
- add products to basket,
- edit product quantity in basket,
- delete product from basket,
- make an order.
As Admin you can:
- view users list,
- add, delete or edit accounts.
As Employee you can:
- add, delete or edit product,
- view orders list,
- edit status or delete order.
# Usage
##
Docker Engine or Docker Desktop is required to run.
##
Open PowerShell in Windows or Terminal in Linux and go to repository folder.\
Run "docker compose up -d" command.\
Wait until server starts.\
Copy the content of db.sql file.\
Go to localhost:8080.\
Go to TTG-SHOP table and open SQL tab then paste content and run script.\
Now you can use website at address localhost.
##
The basic website does not have any products, but you can add them in employee panel.\
3 basic accounts are created in the sql script:\
Admin with login admin and password admin\
Emlpoyee with login emp and password emp\
User with login user and password user

