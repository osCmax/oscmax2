<?php
/*
  $Id: whos_online.php,v 1.0 2009/08/15 15:00:00 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

function get_browser_icon($user_agent) {
	if (stripos($user_agent, 'chrome') > 0){
		$browser_icon = 'logo_chrome.jpg';
	} else {
		if (stripos($user_agent, 'safari') > 0){
			$browser_icon = 'logo_safari.jpg';
		} else {
			if (stripos($user_agent, 'firefox') > 0){
				$browser_icon = 'logo_firefox.jpg';
			} else {
				if (stripos($user_agent, 'MSIE') > 0){
					$browser_icon = 'logo_ie.jpg';
				} else {
					if (stripos($user_agent, 'amaya') > 0){
						$browser_icon = 'logo_amaya.jpg';
					} else {
						if (stripos($user_agent, 'amosaic') > 0){
							$browser_icon = 'logo_amosaic.jpg';
						} else {
							if (stripos($user_agent, 'camino') > 0){
								$browser_icon = 'logo_camino.jpg';
							} else {
								if (stripos($user_agent, 'epiphany') > 0){
									$browser_icon = 'logo_epiphany.jpg';
								} else {
									if (stripos($user_agent, 'meleon') > 0){
										$browser_icon = 'logo_k-meleon.jpg';
									} else {
										if (stripos($user_agent, 'pera') > 0){
											$browser_icon = 'logo_opera.jpg';
										} else {
											if (stripos($user_agent, 'flock') > 0){
												$browser_icon = 'logo_flock.jpg';
											} else {
												if (stripos($user_agent, 'galeon') > 0){
													$browser_icon = 'logo_galeon.jpg';
												} else {
													if (stripos($user_agent, 'ibrowse') > 0){
														$browser_icon = 'logo_ibrowse.jpg';
													} else {
														if (stripos($user_agent, 'konqueror') > 0){
															$browser_icon = 'logo_konqueror.jpg';
														} else {
															if (stripos($user_agent, 'maxthon') > 0){
																$browser_icon = 'logo_maxthon.jpg';
															} else {
																if (stripos($user_agent, 'netscape') > 0){
																	$browser_icon = 'logo_netscape.jpg';
																} else {
																	if (stripos($user_agent, 'netsurf') > 0){
																		$browser_icon = 'logo_netsurf.jpg';
																	} else {
																		if (stripos($user_agent, 'omniweb') > 0){
																			$browser_icon = 'logo_omniweb.jpg';
																		} else {
																			if (stripos($user_agent, 'monkey') > 0){
																				$browser_icon = 'logo_seamonkey.jpg';
																			} else {
																				if (stripos($user_agent, 'shiira') > 0){
																					$browser_icon = 'logo_shiira.jpg';
																				} else {
																					if (stripos($user_agent, 'theworld') > 0){
																						$browser_icon = 'logo_theworld.jpg';
																					} else {
																						if (stripos($user_agent, 'traveler') > 0){
																							$browser_icon = 'logo_traveler.jpg';
																						} else {
																							if (stripos($user_agent, 'voyager') > 0){
																								$browser_icon = 'logo_voyager.jpg';
																							} else {
																								$browser_icon = '';
																							}
																						}
																					}
																				}
																			}
																		}
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
	if ($browser_icon != ''){
		$browser_icon = '<img src="images/browsers/' . $browser_icon . '"> ';
	}
	return $browser_icon;
}

function get_os_icon($user_agent) {
	if (stripos($user_agent, 'Windows') > 0){
		$os_icon = 'logo_windows.jpg';
	} else {
		if (stripos($user_agent, 'Linux') > 0){
			$os_icon = 'logo_linux.jpg';
		} else {
			if (stripos($user_agent, 'Macintosh') > 0){
				$os_icon = 'logo_apple.jpg';
			} else {
				if (stripos($user_agent, 'Amiga') > 0){
					$os_icon = 'logo_amiga.jpg';
				} else {
					if (stripos($user_agent, 'iPhone') > 0){
						$os_icon = 'logo_iphone.jpg';
					} else {
						if (stripos($user_agent, 'SymbianOS') > 0){
							$os_icon = 'logo_symbianos.jpg';
						} else {
							if (stripos($user_agent, 'Java') > 0){
								$os_icon = 'logo_java.jpg';
							} else {
								if (stripos($user_agent, 'plix ') > 0){
									$os_icon = 'logo_aplix.jpg';
								}
							}
						}
					}
				}
			}
		}
	}
	if ($os_icon != ''){
		$os_icon = '<img src="images/os/' . $os_icon . '"> ';
	}
	return $os_icon;
}

function get_isp_icon($hostname) {
	$isp_icon = '';
	if (stripos($hostname, 'otenet') > 0){
		$isp_icon = 'logo_otenet.png';
	} else {
		if (stripos($hostname, 'mycosmos') > 0){
			$isp_icon = 'logo_cosmote.png';
		} else {
			if (stripos($hostname, 'forthnet') > 0){
				$isp_icon = 'logo_forthnet.png';
			} else {
				if (stripos($hostname, 'hol.gr') > 0){
					$isp_icon = 'logo_hol.png';
				} else {
					if (stripos($hostname, 'tellas') > 0){
						$isp_icon = 'logo_tellas.png';
					} else {
						if (stripos($hostname, 'altec') > 0){
							$isp_icon = 'logo_altec.png';
						} else {
							if (stripos($hostname, 'vodafone') > 0 or stripos($hostname, 'panafon') > 0){
								$isp_icon = 'logo_vodafone.png';
							} else {
								if (stripos($hostname, 'netone') > 0){
									$isp_icon = 'logo_netone.png';
								} else {
									if (stripos($hostname, 'ontelecoms') > 0 or stripos($hostname, 'ondsl') > 0){
										$isp_icon = 'logo_ontelecoms.png';
									} else {
										if (stripos($hostname, 'vivodi') > 0){
											$isp_icon = 'logo_vivodi.png';
										} else {
											if (stripos($hostname, 'diodos') > 0){
												$isp_icon = 'logo_diodos.png';
											} else {
												if (stripos($hostname, 'wind') > 0){
													$isp_icon = 'logo_wind.png';
												} else {
													if (stripos($hostname, 'cytanet') > 0 or stripos($hostname, 'cyta.gr') > 0){
														$isp_icon = 'logo_cytanet.png';
													} else {
														if (stripos($hostname, 'cosmoline') > 0){
															$isp_icon = 'logo_cosmoline.png';
														} else {
															if (stripos($hostname, 'athensairport.gr') > 0){
																$isp_icon = 'logo_athensairport.png';
															} else {
																if (stripos($hostname, 'emporiki.gr') > 0){
																	$isp_icon = 'logo_emporiki.png';
																} else {
																	if (stripos($hostname, 'bethere.co.uk') > 0){
																		$isp_icon = 'logo_bethere.co.uk.png';
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
	if ($isp_icon != ''){
		$isp_icon = '<img src="images/isp/' . $isp_icon . '">' . '&nbsp;';
	}
	return $isp_icon;
}

function format_referer_skroutz($referer){
	// www.skroutz.gr is a greek e-shop price comparing service. You don't need this unless you are registered with them
	// Direct link to store
	if (stripos($referer, '/ITsmart') > 0){
		$pretty_referer_link = '<b>IT smart</b>';
	} else {
		$pretty_referer_link = $referer;

		// Deepthought
		if (stripos($referer, 'deepthought') > 0){
			$pretty_referer_link = '<b>Deepthought</b>';
		} else {
			// Search inside a products category
			// For example: http://www.skroutz.gr/c/289/laptop_batteries_and_psu.html?keyphrase=power+supply&page=1
			if (stripos($referer, '.html') > 0 and stripos($referer, 'keyphrase=') > 0){
				$tempstring = $pretty_referer_link;
				$tempstring = strrev($tempstring);
				$tempstring = strstr($tempstring, 'lmth.');
				$tempstring = substr($tempstring, 5);
				$tempstring = strrev($tempstring);
				$tempstring = substr($tempstring, strlen(strstr(strrev($tempstring), '/')));
				$tempstring .= '.html';
				$pretty_referer_link = rawurldecode($referer);
				$pretty_referer_link = strstr($pretty_referer_link, 'keyphrase=');
				$pretty_referer_link = substr($pretty_referer_link, 10);
				$pretty_referer_link = substr($pretty_referer_link, 0, strcspn($pretty_referer_link, "&"));
				$pretty_referer_link = str_replace("+", " ", $pretty_referer_link);
				$pretty_referer_link = $tempstring . ": <b>" . $pretty_referer_link . '</b>';
			} else {
				if (stripos($referer, '.html') > 0 and stripos($referer, 'keyphrase=') == 0){

					// Browsing in a products category
					$pretty_referer_link = strrev($pretty_referer_link);
					$pretty_referer_link = strstr($pretty_referer_link, 'lmth.');
					$pretty_referer_link = substr($pretty_referer_link, 5);
					$pretty_referer_link = strrev($pretty_referer_link);
					$pretty_referer_link = substr($pretty_referer_link, strlen(strstr(strrev($pretty_referer_link), '/')));
					$pretty_referer_link .= '.html';
					$pretty_referer_link = '<b>' . $pretty_referer_link . '</b>';
				} else {

					// Products search (not in a specific category)
					// For example: http://www.skroutz.gr/search?keyphrase=plain+paper&page=1
					$pretty_referer_link = rawurldecode($referer);
					$pretty_referer_link = strstr($pretty_referer_link, 'keyphrase=');
					$pretty_referer_link = substr($pretty_referer_link, 10);
					$pretty_referer_link = substr($pretty_referer_link, 0, strcspn($pretty_referer_link, "&"));
					$pretty_referer_link = str_replace("+", " ", $pretty_referer_link);
					$pretty_referer_link = '<b>' . $pretty_referer_link . '</b>';
				}
			}
		}
	}
	return $pretty_referer_link;
}

function format_referer_ingr($referer){
	$pretty_referer_link = $referer;
	$pretty_referer_link = strrev($pretty_referer_link);
	$pretty_referer_link = strstr($pretty_referer_link, 'lmth.');
	$pretty_referer_link = substr($pretty_referer_link, 5);
	$pretty_referer_link = strrev($pretty_referer_link);
	$pretty_referer_link = substr($pretty_referer_link, strlen(strstr(strrev($pretty_referer_link), '/')));
	$pretty_referer_link .= '.html';
	$pretty_referer_link = '<b>' . $pretty_referer_link . '</b>';
	if ($pretty_referer_link == '<b>.html</b>') {
		//http://www.skroutz.gr/search?keyphrase=mixanografiko+xarti&page=1
		$pretty_referer_link = rawurldecode($referer_link);
		$pretty_referer_link = strstr($pretty_referer_link, 'q=');
		$pretty_referer_link = substr($pretty_referer_link, 2);
		$pretty_referer_link = substr($pretty_referer_link, 0, strcspn($pretty_referer_link, "&"));
		$pretty_referer_link = str_replace("+", " ", $pretty_referer_link);
		$pretty_referer_link = '<b>' . $pretty_referer_link . '</b>';
	}
	return $pretty_referer_link;
}

function format_referer_google($referer){
	$pretty_referer_link = $referer;
	$pretty_referer_link = strstr($pretty_referer_link, 'q=');
	$pretty_referer_link = substr($pretty_referer_link, 2);
	$pretty_referer_link = substr($pretty_referer_link, 0, strcspn($pretty_referer_link, "&"));
	$pretty_referer_link = str_replace("+", " ", $pretty_referer_link);
	$pretty_referer_link = '<b>' . $pretty_referer_link . '</b>';
	return $pretty_referer_link;
}

function format_referer_url($referer, $f) {
	if (stripos($referer, 'www.google.') > 0){
		$referer_icon = 'logo_google.jpg';
		if ($f == 'link'){
			$pretty_referer_link = format_referer_google($referer);
		}
	} else {
	if (stripos($referer, 'bing.com') > 0){
		$referer_icon = 'logo_bing.jpg';
		if ($f == 'link'){
			// The function format_referer_google works for Bing as well
			$pretty_referer_link = format_referer_google($referer);
		}
	} else {
	if (stripos($referer, 'facebook.com') > 0){
		$referer_icon = 'logo_facebook.jpg';
	} else {
	if (stripos($referer, 'live.com') > 0){
		$referer_icon = 'logo_windowslive.jpg';
		if ($f == 'link'){
			// The function format_referer_google works for live.com as well
			$pretty_referer_link = format_referer_google($referer);
		}
	} else {
	if (stripos($referer, 'ask.com') > 0){
		$referer_icon = 'logo_ask.jpg';
		if ($f == 'link'){
			// The function format_referer_google works for ask.com as well
			$pretty_referer_link = format_referer_google($referer);
		}
	} else {
	if (stripos($referer, 'sweetim.com') > 0){
		$referer_icon = 'logo_sweetim.jpg';
		if ($f == 'link'){
			// The function format_referer_google works for search.sweetim.com as well
			$pretty_referer_link = format_referer_google($referer);
		}
	} else {
	if (stripos($referer, 'skroutz.gr') > 0){
		$referer_icon = 'logo_skroutz.jpg';
		if ($f == 'link'){
			$pretty_referer_link = format_referer_skroutz($referer);
		}
	} else {
	if (stripos($referer, 'eprice.gr') > 0){
		$referer_icon = 'logo_eprice.jpg';
	} else {
	if (stripos($referer, 'razerzone.com') > 0){
		$referer_icon = 'logo_razer.jpg';
	} else {
	if (stripos($referer, 'spyder.gr') > 0){
		$referer_icon = 'logo_spyder.jpg';
	} else {
	if (stripos($referer, 'mame.gr') > 0){
		$referer_icon = 'logo_mame.gr.jpg';
	} else {
	if (stripos($referer, 'pricetag.gr') > 0){
		$referer_icon = 'logo_pricetag.jpg';
	} else {
	if (stripos($referer, 'retromaniax.gr') > 0){
		$referer_icon = 'logo_retromaniax.jpg';
	} else {
	if (stripos($referer, '.in.gr') > 0){
		$referer_icon = 'logo_in.gr.jpg';
		if ($f == 'link'){
			$pretty_referer_link = format_referer_ingr($referer);
		}
	} else {
	if (stripos($referer, 'retrogamer.gr') > 0){
		$referer_icon = 'logo_retrogamer.gr.jpg';
	} else {
	if (stripos($referer, 'roccat.org') > 0){
		$referer_icon = 'logo_roccat.jpg';
	} else {
	if (stripos($referer, 'insomnia.gr') > 0){
		$referer_icon = 'logo_insomnia.jpg';
	} else {
	if (stripos($referer, 'thelab.gr') > 0){
		$referer_icon = 'logo_thelabgr.jpg';
	}}}}}}}}}}}}}}}}}}
	if ($referer_icon != ''){
		$referer_icon = '<img src="images/referer/' . $referer_icon . '"> ';
	}
	if ($f == 'icon'){
		return $referer_icon;
	} else {
		if ($f == 'link'){
			return $pretty_referer_link;
		} else {
			return '';
		}
	}
}
?>