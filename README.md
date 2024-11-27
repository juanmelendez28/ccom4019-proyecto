# ccom4019-proyecto



### Setting up the database
- Import the [DDL](https://cursos.upra.edu/pluginfile.php/617026/mod_assign/introattachment/0/Free_Electives_DB.sql?forcedownload=1) from the project onto phpmyadmin
- Configure your credentials on the `config.php` file under the `util` folder
- Go to the index file on your browser, it should output something like this:

![alt text](image.png)
FIG 1 - If you have no records it should return `NULL`

![alt text](image-1.png)
FIG 2 - Example with test data, notice that `password` is hidden on values since we've defined it under the `hidden` array on the `User` model.