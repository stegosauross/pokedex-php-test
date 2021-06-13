# Pokedex App

A small app for viewing information for Pokemon. Built on Slim Framework 4, utilising PokeAPI.

## Installation

`composer install`

## Usage

`/` Main page: list of Pokemon.
`/pokemon/{name}` View specfic Pokemon.

## Libraries used
- **Slim Framework**
- **Twig**
- **DataTables:** Allows an accessible and paginated display of Pokemon names. Also enables us to limit the amount of data returned from the API by making a request per page.
- **GuzzleHttp:** To facilitate calls to PokeAPI.
