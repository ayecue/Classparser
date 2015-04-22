# Classparser

> Compatible with Pimcore 3.x.x

Plugin to enable user in the CMS to add their own classes to a component. When you install this plugin an Object named "Classhelper" will be automaticly added. This object got two default fields. One mandatory field named "classtag" and one optional field named "description".

Use the field "classtag" to define classes like for example "bgcolor-blue". Use the field "description" to describe to the user what this class does. In this example I just would write something like "Makes background blue!".

Example:

Imagine you got this CSS file:
```
.bgcolor-blue {
	background: blue;
}
.bar {
	color: black;
}
.foo {
	border: 0;
}
```

Also imagine that you got a view like this:
```
<?php
	$myClassparser = $this->classparser("myDivClasses");

	if ($this->editmode) {
		echo $myClassparser;
	}
?>
<div class="<?php echo $myClassparser->getClass(); ?>">
</div>
```

Now imagine that you have added three different classes to the classparser like "bgcolor-blue", "bar" and "doh". The output would be:
```
<div class="bgcolor-blue bar doh">
</div>
```