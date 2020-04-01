# Coding guidelines 

## Git
We're working with a variation of the [Gitflow Workflow](https://www.atlassian.com/git/tutorials/comparing-workflows/gitflow-workflow). This means that every issue will have it's own **feature branch** and will be merged into develop via a **Pull request**.

The naming convention for branches is as follows :
```
<version>/#<issue_nb>-<description>

e.g.
v1/#42-foobar
```

### Commit messages
Please format your commit messages as follows: 
```
#<issue_nb> Short summary of the change (up to 50 characters)

Optionally add a more extensive description of your change after a
blank line. Wrap the lines in this and the following paragraphs after
72 characters.
```

## PHP
### Coding style
We will be following the [PSR-12 coding style](https://www.php-fig.org/psr/psr-12/).

We highly recommend you install a linter. For instance, you can install [this one](https://marketplace.visualstudio.com/items?itemName=ikappas.phpcs) if you are using vscode.

### Unit tests
Unit tests will be written with the framework PHPUnit. 

[documentation](https://phpunit.readthedocs.io/en/9.0/)

## Javascript
### Coding style
We will be following [Airbnbs coding style](https://github.com/airbnb/javascript).

As for PHP, we highly recommand you install ESLint as linter so you can use the [config](https://github.com/airbnb/javascript/blob/master/linters/.eslintrc) proposed by Airbnb. For vscode, you can install [this addon](https://marketplace.visualstudio.com/items?itemName=dbaeumer.vscode-eslint).

### Unit tests
Unite tests will be written with [Jest](https://jestjs.io/) and [Vue Test Utils](https://vue-test-utils.vuejs.org/).
