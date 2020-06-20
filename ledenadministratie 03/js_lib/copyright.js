function copyRight() {

	let now = new Date();

	/**** locatie en bedrijf ****/
	let location =  "<em>Antwerp &hyphen; Belgium</em>";
	let owner = "<b><em>webontwikkeling.info</em></b>";
	
	/**** array's dag en maand ****/
	let days =  ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday" ];
	let months = ["january", "february", "march", "april", "mei", "june", "july", "august", "september", "october", "november", "december" ];

	/**** uur en minuten + '0'-toevoegen bij enkele getallen ****/
	let hour = now.getHours();
	let minutes = now.getMinutes();
	let time = `${hour < 10 ? '0' : ''}${hour}:${minutes < 10 ? '0' : ''}${minutes}`;

	/**** dag, datum, maand, jaar ****/
	let today =	" <b>" + days[now.getDay()] + "</b> &bull; " + now.getDate() +
        		" " + months[now.getMonth()] + " <b>" + now.getFullYear() +"</b>";
	
	/**** gehele string ****/
	let copyright_string = "&bull; " + today + " &bull; " + time + " &bull; " + location + " &copy; " + owner + " &bull;";		 
	
	/**** string doorsturen ****/
	return(copyright_string);
	
}