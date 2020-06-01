# Prerequisites
1. Laravel 7.x.
2. MySQL/MongoDB.
3. Database user with all granted priviliges on database named `math_exam_dblab`.

# How to install?
Run following commands:
```
git clone https://github.com/PdaOgu/OnlineMathExaminingDBLab.git
cd OnlineMathExamining
cp .env.example .env
php artisan key:generate
nano .env
```
Edit these fields with your database credentials
```
DB_USERNAME=<username>
DB_PASSWORD=<password>
```
Save .env and finally, run:
```
mysql -u '<username>'@'<host>' '-p<password>' < database_schema.sql
php artisan serve
```

