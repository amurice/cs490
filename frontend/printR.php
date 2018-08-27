<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>jQuery UI Sortable - Connect lists</title>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css" />
  <style>
  #sortable1, #sortable2 { list-style-type: none; margin: 0; padding: 0 0 2.5em; float: left; margin-right: 10px; }
  #sortable1 li, #sortable2 li { margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; width: 120px; }
  </style>
  <script>
  $(function() {
    $( "#sortable1, #sortable2" ).sortable({
      connectWith: ".connectedSortable"
    }).disableSelection();
  });
  </script>
</head>
<body>

<table >
<tbody id="sortable1" class="connectedSortable">
  <tr class="ui-state-default"><td>Item 1</td></tr>
  <tr class="ui-state-default"><td>Item 2</td></tr>
  <tr class="ui-state-default"><td>Item 3</td></tr>
  <tr class="ui-state-default"><td>Item 4</td></tr>
  <tr class="ui-state-default"><td>Item 5</td></tr>
</tbody>
</ul>


 <table>
<tbody id="sortable2" class="connectedSortable">
  <tr class="ui-state-highlight"><td>Item 1</td></tr>
  <tr class="ui-state-highlight"><td>Item 2</td></tr>
  <tr class="ui-state-highlight"><td>Item 3</td></tr>
  <tr class="ui-state-highlight"><td>Item 4</td></tr>
  <tr class="ui-state-highlight"><td>Item 5</td></tr>
</tbody>
</ul>


</body>
</html>
