
var contador = 1;
 
function abrircerrar()
{
	if(contador == 1)
	{
		$("nav").animate({left: '0'});
		contador = 0;
	}else 
	{
		contador = 1;
		$("nav").animate({left: '-100%'});
	}
}