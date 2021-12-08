# NERVA (XNV) PHP API

Copyright (c) 2021 The NERVA Project.  

## Setting up Analytics
You only need to do this part if your node is seed and you want it to collect analytics data. 

To get analytics working on a seed a node server, install MySQL. You can use [this article][setup-sql-tutorial] as guide.

You might also need this (change php version to what you have installed): 
```bash
sudo apt-get install php7.4-mysql
```
```bash
sudo systemctl restart apache2
```
```bash
sudo systemctl restart mysql
```

Once MySQL is installed properly, run scripts from database\create_scripts.



[setup-sql-tutorial]: https://www.digitalocean.com/community/tutorials/how-to-install-mysql-on-ubuntu-20-04