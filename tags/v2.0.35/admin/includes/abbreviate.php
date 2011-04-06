<?php

function abbreviate_country($country) {
	switch ($country) {
      case 'United States':
        $country = 'US';
        break;
			case 'Canada':
        $country = 'CA';
        break;				
				}
			return $country;
			}						

function abbreviate_state($state) {
		switch ($state) {
      case 'Alabama':
        $state = 'AL';
        break;
      case 'Alaska':
        $state = 'AK';
        break;
      case 'American Samoa':
        $state = 'AS';
        break;
      case 'Arizona':
        $state = 'AZ';
        break;
      case 'Arkansas':
        $state = 'AR';
        break;
			case 'California':
        $state = 'CA';
        break;
			case 'Colorado':
        $state = 'CO';
        break;
			case 'Connecticut':
			  $state = 'CT';
			  break;
			case 'Delaware':
			  $state = 'DE';
			  break;
			case 'District of Columbia':
			  $state = 'DC';
			  break;
			case 'Federated States of Micronesia':
			  $state = 'FM';
			  break;
			case 'Florida':
			  $state = 'FL';
			  break;
			case 'Georgia':
			  $state = 'GA';
			  break;
			case 'Guam':
			  $state = 'GU';
			  break;
			case 'Hawaii':
			  $state = 'HI';
			  break;
			case 'Idaho':
			  $state = 'ID';
			  break;
			case 'Illinois':
			  $state = 'IL';
			  break;
			case 'Indiana':
			  $state = 'IN';
			  break;
			case 'Iowa':
			  $state = 'IA';
			  break;
			case 'Kansas':
			  $state = 'KS';
			  break;
			case 'Kentucky':
			  $state = 'KY';
			  break;
			case 'Louisiana':
			  $state = 'LA';
			  break;
			case 'Maine':
			  $state = 'ME';
			  break;
			case 'Marshall Islands':
			  $state = 'MH';
			  break;
			case 'Maryland':
			  $state = 'MD';
			  break;
			case 'Massachusetts':
			  $state = 'MA';
			  break;
			case 'Michigan':
			  $state = 'MI';
			  break;
			case 'Minnesota':
			  $state = 'MN';
			  break;
			case 'Mississippi':
			  $state = 'MS';
			  break;
			case 'Missouri':
			  $state = 'MO';
			  break;
			case 'Montana':
			  $state = 'MT';
			  break;
			case 'Nebraska':
			  $state = 'NE';
			  break;
			case 'Nevada':
			  $state = 'NV';
			  break;
			case 'New Hampshire':
			  $state = 'NH';
			  break;
			case 'New Jersey':
			  $state = 'NJ';
			  break;
			case 'New Mexico':
			  $state = 'NM';
			  break;
			case 'New York':
			  $state = 'NY';
			  break;
			case 'North Carolina':
			  $state = 'NC';
			  break;
			case 'North Dakota':
			  $state = 'ND';
			  break;
			case 'Northern Mariana Islands':
			  $state = 'MP';
			  break;
			case 'Ohio':
			  $state = 'OH';
			  break;
			case 'Oklahoma':
			  $state = 'OK';
			  break;
			case 'Oregon':
			  $state = 'OR';
			  break;
			case 'Palau':
			  $state = 'PW';
			  break;
			case 'Pennsylvania':
			  $state = 'PA';
			  break;
			case 'Puerto Rico':
			  $state = 'PR';
			  break;
			case 'Rhode Island':
			  $state = 'RI';
			  break;
			case 'South Carolina':
			  $state = 'SC';
			  break;
			case 'South Dakota':
			  $state = 'SD';
			  break;
			case 'Tennessee':
			  $state = 'TN';
			  break;
			case 'Texas':
			  $state = 'TX';
			  break;
			case 'Utah':
			  $state = 'UT';
			  break;
			case 'Vermont':
			  $state = 'VT';
			  break;
			case 'Virgin Islands':
			  $state = 'VI';
			  break;
			case 'Virginia':
			  $state = 'VA';
			  break;
			case 'Washington':
			  $state = 'WA';
			  break;
			case 'West Virginia':
			  $state = 'WV';
			  break;
			case 'Wisconsin':
			  $state = 'WI';
			  break;
			case 'Wyoming':
			  $state = 'WY';
			  break;
			}
		return $state;
		}
		
?>