# Plain PHP framework
#### Technical info.

No libraries used. Written from scratch. Super light framework, size of 10kB.

Used design patterns:

1. Singleton
2. Service Locator
3. Facade
4. Lazy Loading

#### Installation
``` bash
git clone https://github.com/cernei/plain-php-framework.git

cd plain-php-framework
composer install
```
To create tables for the Demo App specify db credentials in **app/config/db.php** then run
``` bash
php ./install.php
```
## Features

#### Using Facades
Specify Facade class in **app/Facades** in order to use syntax:
``` php
Config::get('routes')
// instead of 
app()->get('App\\System\\Config')->get('routes')
```
Also don't forget to import facade where you use it.
``` php
use \Config;

//...
```
Since they declared globally you are free to use them in view files.

##### Working with database
``` php
User::where(['type' => 2]);
User::where(['user_id' => 1, 'vacancy_id' => 3]); // AND junction
User::orWhere(['user_id' => 1, 'user_id' => 2]); // OR junction

User::where(['id' => 2]);
User::find(2); // get one record by specified id
User::all();

User::insert(['email' => 'user3@gmail.co']);
User::update(['email' => 'user3@gmail.com'], ['email' => 'user3@gmail.co']); // set and where
User::delete(['id' => '5']);
```


##### one-to-one relationship
In order to resolve relationship use ```oneToOne``` helper to add related data 
``` php
$replies = Reply::where(['company_id' => $id]);

$replies = Reply::oneToOne('candidate', $replies);
```
``` php
class Reply extends Model {

    //...
    
    public function candidate()
    {
        return ['users', 'candidate_id', 'id'];
    }
    
    //...
}
```

### Testing
Run php unit within project root:
``` bash
./vendor/bin/phpunit
```
To create a class in a container with special parameters use: 
``` php
 app()->make('App\\System\\Request' , ['/', 'GET']);
```
**make** method params are: _name class_ and _params_ for ```__construct``` method

### Demo app
Simple service for finding a job.
There are two types of users: Companies and Candidates.
Companies can post a vacancy and Candidates can apply for desired position.
