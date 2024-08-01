## Description

<!--- Describe your changes in further detail, if necessary. -->
<!--- Please add a link to a github issue, if exists -->

## Checklist

<!--- This checklist serves as a tool for the developer and reviewer. Check the boxes if a criteria does not apply to you're merge request or it is resolved. -->

### Documentation

- [ ] Documentation is generated (if updated) (`composer docs-generator`)
- [ ] Pull request is added to CHANGELOG.md

### Coding Style
- [ ] Request classes 
    - [ ] follow the existing [naming conventions](https://github.com/5pm-HDH/churchtools-api/blob/master/docs/out/Requests.md) (plural for builders, singular for objects)
- [ ] Model classes 
  - [ ] have default values for properties and protected visibility
  - [ ] have getters and setters for properties
- [ ] methods with return type "array" have PHPDoc annotation with class if applicable (e.q.: `/** @return Group[] */`)
- [ ] CodingStyle enforcement is executed (`composer php-cs-fixer`)

### Test

- [ ] Integration test is added (if necessary)
- [ ] Unit test is created (if necessary)
