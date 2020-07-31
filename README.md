Currecny converter tech test

Once setup, run "php artisan migrate --seed",
this downloads and inserts the currecy conversion rates into the database.

Exchange rates change all the time, so ideally this would be a cronjob's job in a real world situation.

Source: from http://www.floatrates.com/daily/gbp.xml

Api has been configured for passport, however it is not used, this is to just consider sclability. 
A new folder structure for the API has been added to accomidate api versioning. 

See api\v1.

I didn't bother using https://gbp.fxexchangerate.com/rss.xml, as i already have the codes in the database, so i sourced from this.

Currently only converts GBP to xxx, though with more data, its simple enouth to ehance the component.
