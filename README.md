<h1 align="center">Lumen Form Requests</h1>
<p align="center"><em>Laravel-like form requests built for Lumen</em></p>

<p align="center">
  <a href="LICENSE"><img src="https://img.shields.io/github/license/photogabble/lumen-form-request.svg" alt="License"></a>
</p>

## About

While working on an api utilising the Lumen framework I found myself missing the FormRequest functionality that comes out of the box with Laravel. 

A quick Google search discovered [this](https://medium.com/@mikimaineamdu/how-to-bring-back-form-request-to-lumen-5-x-fb67e4a51f53) article by [Mikiyas Amdu](https://medium.com/@mikimaineamdu). 

The code in the article is a little out of date and while I was updating it for use in one of my projects I decided to break out the code into this small library so I could use it in my other Lumen projects.

Mikiyas original code dealt with redirects and sessions; in order to keep this implementation in line with how Lumen is intended to be used I have stripped out that functionality and coded for returning Json responses.

## Install

Install with `composer require photogabble/lumen-form-request` and then enable the library in your `bootstrap/app.php` file with:

```
$app->register(\Photogabble\LumenFormRequest\LumenFormGeneratorServiceProvider::class);
```

## Usage

Create a new form request with the command `make:api-request {request name}` and the command will create a new file in your `app/Http/Requests` path (creating it if it does not already exist).

## Not invented here

A little further digging and I discovered that Mikiyas had already wrapped their implementation into the [urameshibr/lumen-form-request](https://packagist.org/packages/urameshibr/lumen-form-request) library.

## License

[MIT](LICENSE)
