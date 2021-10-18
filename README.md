# Allarium Gravity Forms Validation plugin README

This plugin is build to add to the functionality of Gravity Forms. AGF unique validation forces fields to have unique values. By entering the IDs a group can be created, this group of items must be unique to each other.


## Getting Started

1. `Install plugin on WordPress`
2. `Edit code in either a snipit plugin or in the functions.php`
```
if (class_exists('AGFVValidationCheck')) {
	new AGFVValidationCheck( array(
		'form_id' => 36,
		'field_ids' => array(array(40, 41, 42, 43), array(47, 48, 49, 50), array(51,52,53,54))
	 ));
}
```


## Prerequisites
1. `Minimum WordPress version 5.81`
2. `Minimum Gravity Form version 2.5.10.1`


## Authors
- **Isaiah Proctor** - **Allarium** - Full Credit - [PlutoTom](https://github.com/plutotom)

## License
This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
