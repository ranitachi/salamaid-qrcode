<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
    
<div class="visible-print text-center">
     
    {!! QrCode::size(350)->generate($url); !!}
     
</div>
    
</body>
</html>