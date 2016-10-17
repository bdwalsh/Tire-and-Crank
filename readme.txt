readme.txt

//////////
COMP 4130
Final Project
Due: March 25, 2016
///////////////////

Submitted to: Arron Ferguson
Submitted by: Peter Dekker & Brendan Walsh

Site setup:

load up our database file tire_and_crank_db.txt
we used a database "tire_and_crank" - if you use a different one, please modify the DBConnector.php

our site was built using foundation as a CSS framework.

you can log into the site with the username "aaa" and password "123".

Features:

Our site completes all the tasks from the required features.

We also added images to our products, which are referenced by URL in the database.
We did not add a feature to upload images, which would be nice. The web app will default to a standard image in that case.

You can add/remove/edit quantity of items in the shopping cart.
Our inventory management was working, except now that the layout is in table form, instead of a list.
it was working prior, couldn't get it to connect and do a proper inventory check.

Once logged in as a user/admin you can add products, edit their values, and add to the inventory.

The password in the user database is hashed with md5 and salt. there is no feature to add a user, but the password check does work.  See UserManager.php for this feature.