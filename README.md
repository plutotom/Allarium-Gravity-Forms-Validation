# Allarium Gravity Forms Validation plugin README

This plugin is build to add to the functionality of Gravity Forms. AGF unique validation forces fields to have unique values. By entering the IDs a group can be created, this group of items must be unique to each other.


## Getting Started

1. `Install plugin on WordPress`
2. `Edit code in either a snipit plugin or in the functions.php`
3. Configure the snippet

Enter your form ID for the `form_id` parameter.
Enter each group of field IDs that should be unique for the field_ids parameter. Each array (group of unique fields) should be an array in an array.
Optionaly add a custom error message. `'error_message' => "Please make sure all values are unique."`

```
if (class_exists('AGFVValidationCheck')) {
	new AGFVValidationCheck( array(
		'form_id' => 36,
		'field_ids' => array(array(40, 41, 42, 43), array(47, 48, 49, 50), array(51, 52 ,53 ,54))
	 ));
}
```
```
$group_one = array(6, 7, 9, 10);
$group_two = array(12, 13, 14, 15);
$group_three = array(17, 18, 19, 20);

new AGFVValidationCheck( array(
	'form_id' => 1,
	'field_ids' => array($group_one, $group_two, $group_three)
 ) );
```
```
if (class_exists('AGFVValidationCheck')) {
	new AGFVValidationCheck( array(
	'form_id' => 1,
	'field_ids' => array(array(6,7,9,10), array(12, 13, 14, 15)),
	'error_message'       => "Please make sure all values are unique."
 ) );
}
```


## Prerequisites
1. `Minimum WordPress version 5.81`
2. `Minimum Gravity Form version 2.5.10.1`


## Authors
- **Isaiah Proctor** - **Allarium** - Full Credit - [PlutoTom](https://github.com/plutotom)

## License
This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
