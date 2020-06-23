function copyRight() {

	let now = new Date();

	/**** locatie en bedrijf ****/
	let location =  "<b>Antwerp &hyphen; Belgium</b>";
	let owner = "<a href='https://www.stedelijkonderwijs.be/encora/opleiding/webontwikkelaar'><em>webontwikkeling.info</em></a>";
	
	/**** array's dag en maand ****/
	let days =  ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday" ];
	let months = ["january", "february", "march", "april", "mei", "june", "july", "august", "september", "october", "november", "december" ];

	/**** uur en minuten + '0'-toevoegen bij enkele getallen ****/
	let hour = now.getHours();
	let minutes = now.getMinutes();
	let time = `${hour < 10 ? '0' : ''}${hour}:${minutes < 10 ? '0' : ''}${minutes}`;

	/**** dag, datum, maand, jaar ****/
	let today =	"&nbsp;" + days[now.getDay()] + "&nbsp;&bull;&nbsp;" + now.getDate() +
        		"&nbsp;" + months[now.getMonth()] + "&nbsp;<b>" + now.getFullYear() +"</b>&nbsp;";
	
	/**** gehele string ****/
	let copyright_string = "&bull;&nbsp;" + today + " &bull; " + time + "&nbsp;&bull;&nbsp;" + location + "&nbsp;&copy;&nbsp;" + owner + "&nbsp;&bull;";		 
	
	/**** string doorsturen ****/
	return(copyright_string);
	
}