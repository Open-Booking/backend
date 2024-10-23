# Next Architecture

## Next Architecture
Clean Code Structure based on Modular and Job Driven Architectures. Extracted and used from Original package https://github.com/laranex/next-laravel.

# Principles

> Next Laravel is not a new framework, it is just a set of principles which you can follow to build a better Laravel Application.
> You just need to follow the following principles, and the Application will turn into `better` and more `human-readable` code.

### Routes

Route are just the same as Laravel default routes.

### Module
Module is where we wrap our business layers into separate units. A module can have followings.
- HTTP
  - Controllers
  - Requests
- Features
- Jobs

>**Warning**  
Resources under modules are `not sharable` across the application and these are intended for single purpose.
This means that you can only consume these resources from the same module.

### Controller

Controller is Responsible for
- Serving the Feature
- Returning everything returned from Feature to the Request

### Feature

Feature is Responsible for
- Validating the Request
- Running Job(s)/Operations(s)
- Mapping the data from Job(s) to response
- Returning the HTTP Response to the Controller Method

### Request

Request is Responsible for
- Validating the incoming HTTP Request
- Authorization of the Request

### Operation

Operation is Responsible for
- Running the Job(s)

### Job

Job is Responsible for
- Handling Laravel Models
- Providing the data to Feature

### Operation VS Feature

Even though both of Operation and Feature are responsible for running the Job(s), there is a slight difference between them.
- Feature can be served from the Controller but the Operation cannot be.
- Operation can only be run from the Feature. It means it cannot work without the Feature.
- Operation is optional in application, but the Feature is not.

>**Tip**  
Operation can be useful in running a set of Jobs which will have to be run from the another Feature as well.
Instead of running same Job(s) from multiple Features, we can `collect those duplicate Job(s) into a single Operation`,
and run that Operation from multiple Features.

...

# Usage

## Route

You can generate a route by following command.

```bash
php artisan next:route blog v1 --api
```
> **Info**
Generated route will be at `routes/api/v1/blog.php`

### Arguments

- route : name of the generated route file
- versionOrDirectory (optional) : version of the route or directory where the route file will be generated

### Options

- --api : generated route file will be store in a api
- --force : the command will fail if there is existing file with the given path and name, this option will delete the existing file and replace with new generated file

### Calling A Controller Action

```php
Route::group(['prefix' => '/v1/blogs'], function() {
    Route::post('/', [BlogController::class, 'store']);
});
```
---
## Controller

You can generate a controller by following command.

```bash
php artisan next:controller Blog Blog
```
> **info**  
Generated controller will be at `app/Modules/BlogModule/Http/Controllers/BlogController.php`

### Arguments

- controller : name of the generated controller file
- module : name of the module where the controller file will be generated

### Options

- --force : the command will fail if there is existing file with the given path and name, this option will delete the existing file and replace with new generated file
- See more at
  - [ControllerMakeCommand.php](https://github.com/laranex/next-laravel/blob/master/src/Commands/ControllerMakeCommand.php)

### Serving Features
> **Warning  
The controller must extend the Next Laravel controller `Laranex\NextLaravel\Cores\Controller` to work with the `serve` method.

All you need to do is call `serve` within the controller method.
```php
use App\Modules\BlogModule\Features\StoreBlogFeature;
use Laranex\NextLaravel\Cores\Controller;

class BlogController extends Controller
{
    public function store()
    {
        return $this->serve(StoreBlogFeature::class);
        //OR
        return $this->serve(new StoreBlogFeature());
    }
}
```
---
# Feature

You can generate a feature by following command.

```bash
php artisan next:feature StoreBlog Blog
```
> **info**  
Generated feature will be at `app/Modules/BlogModule/Features/StoreBlogFeature.php`

### Arguments

- feature : name of the generated feature file
- module : name of the module where the feature file will be generated

### Options

- --force : the command will fail if there is existing file with the given path and name, this option will delete the existing file and replace with new generated file

### Running Jobs
> **Warning**
Feature must extend the Next Laravel feature `App\Next\Core\Feature` to work with the `run` or `runInQueue` method.

Running jobs from a feature or an operation is straightforward using `run` method.
```php
use App\Modules\BlogModule\Jobs\StoreBlogJob;
use App\Modules\BlogModule\Http\Requests\StoreBlogRequest;
use App\Next\Cores\Feature;

class StoreBlogFeature extends Feature
{
    public function handle(StoreBlogRequest $request): Blog
    {
        return $this->run(StoreBlogJob::class, ['payload' => $request->validated()]);
        // Or
        return $this->run(new StoreBlogJob($request->validated()));
        // Or
        return $this->run(new StoreBlogJob(payload: $request->validated()));
    }
}
```

### Running Queue Jobs
Running queue jobs from a feature or an operation is straightforward using `runInQueue` method.
```php
use App\Modules\BlogModule\Jobs\StoreBlogJob;
use App\Modules\BlogModule\Http\Requests\StoreBlogRequest;
use App\Next\Core\Feature;

class StoreBlogFeature extends Feature
{
    public function handle(StoreBlogRequest $request): Blog
    {
        $blog = $this->run(new StoreBlogJob($request->validated()));
        
        $this->runInQueue(new NotifyViaEmailJob($blog));
        
        return $blog;
    }
}
```

### Running Operations
An Operation can be run using the `run` method.
```php
use App\Modules\BlogModule\Jobs\StoreBlogJob;
use App\Modules\BlogModule\Http\Requests\StoreBlogRequest;
use App\Models\Blog;
use App\Modules\BlogModule\Operations\NotifySubscribersOperation;
use App\Next\Core\Feature;

class StoreBlogFeature extends Feature
{
    public function handle(StoreBlogRequest $request): Blog
    {
        $blog = $this->run(new StoreBlogJob($request->validated()));
        
        $this->run(new NotifySubscribersOperation($blog));
        
        return $blog;
    }
}
```
---
# Job

You can generate a job by following command.

```bash
php artisan next:job StoreBlog Blog
```
> **info** 
Generated job will be at `app/Modules/BlogModule/Jobs/StoreBlogJob.php`

### Arguments

- job : name of the generated job file
- module : name of the module where the job file will be generated

### Options
- --queue : the job will be generated as queueable job
- --force : the command will fail if there is existing file with the given path and name, this option will delete the existing file and replace with new generated file

### Job
```php
use App\Next\Core\Job;

class StoreBlogJob extends Job
{
    private array $payload;

    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }

    public function handle(): void
    {
        // here is your logic to handle data
    }
}
```

### Queue Job
You may turn any job into a queueable job that will be dispatched using Laravel Queues rather than running synchronously, 
by simply extending `App\Next\Core\QueueableJob`.
```php
use App\Next\Core\QueueableJob;

class NotifyViaEmailJob extends QueueableJob
{
    private array $payload;

    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }

    public function handle(): void
    {
        // notify to each subscriber will be processed in the queue
    }
}
```
---
# Operation

You can generate an operation by following command.

```bash
php artisan next:operation NotifySubscribersOperation Blog
```
> **info**
Generated operation will be at `app/Modules/BlogModule/Operations/NotifySubscribersOperation.php`

### Arguments

- operation : name of the generated operation file
- module : name of the module where the operation file will be generated

### Options

- --force : the command will fail if there is existing file with the given path and name, this option will delete the existing file and replace with new generated file

### Calling Jobs From Operation
> **Warning  
Operation must extend the Next Laravel operation `App\Next\Core\Operation` to work with the `run` or `runInQueue` method.

Calling jobs from a feature or an operation is straightforward using `run` method.
```php
use App\Modules\BlogModule\Jobs\NotifyViaEmailJob;
use App\Modules\BlogModule\Jobs\NotifyViaPushNotificationJob;
use App\Next\Core\Operation;

class NotifySubscribersOperation extends Operation
{
    private array $payload;

    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }

    public function handle(): void
    {
        $this->run(new NotifyViaEmailJob($this->payload));
        
        $this->run(new NotifyViaPushNotificationJob($this->payload));
    }
}
```

### Calling Queue Jobs From Operation
Calling queue jobs from a feature or an operation is straightforward using `runInQueue` method.
```php
use App\Modules\BlogModule\Jobs\NotifyViaEmailJob;
use App\Modules\BlogModule\Jobs\NotifyViaPushNotificationJob;
use App\Next\Core\Operation;

class NotifySubscribersOperation extends Operation
{
    private array $payload;

    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }

    public function handle(): void
    {
        $this->runInQueue(new NotifyViaEmailJob($this->payload));
        
        $this->runInQueue(new NotifyViaPushNotificationJob($this->payload));
    }
}
```
---
# Request

You can generate a request by following command.

```bash
php artisan next:request StoreBlog Blog
```
> **Info**  
Generated request will be at `app/Modules/BlogModule/Http/Requests/StoreBlogRequest.php`

### Arguments

- request : name of the generated request file
- module : name of the module where the request file will be generated

### Options

- --force : the command will fail if there is existing file with the given path and name, this option will delete the existing file and replace with new generated file


### Request
```php
use App\Next\Core\Request;

class StoreBlogRequest extends Request
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // here is your validation rules
    }
}
```
