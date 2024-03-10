<?php
	defined('_JEXEC') or die('Access deny');

	class plgContentModalPDF extends JPlugin 
	{

		function onContentPrepare($content, $article, $params, $limit){				
			$document = JFactory::getDocument();
			$document->addStyleSheet('plugins/content/modalpdf/style.css');
			
			$re = '/{modalpdf}(.*){\/modalpdf}/m';
			preg_match_all($re, $article->text, $matches, PREG_SET_ORDER, 0);
			$a =explode("/",$matches[0][1]);
			$index=count($a);
			$i=0;

			//Tout le CSS est dans bootstrap, lui-même étant intégré dans Joomla, d'où aucun appel à une bibliothèque externe!
			foreach($matches as $Y)
			{
				
				$n = end(explode('/',$Y[1]));
	
				/*********************
				 * Dans la ligne suivante, $a[$index-1] permet de réafficher le nnom du fichier à afficher dans la modale
				 * La premiere ligne permet 
				
				*/
				
				$subst = '	<!-- Button trigger modal --><p><button type="button" class="btnmodalSEO" data-toggle="modal" data-target="#modalePDFSEO">
							&#'.$this->params->get('icone').';'.$n.'</button></p>
							<!-- Modal -->
							<div id="modalePDFSEO" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									// <div class="modal-content modalcontentSEO">
										<div class="modal-header">
											<h5 id="exampleModalLabel" class="modal-title"></h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
													<span aria-hidden="true">×</span> 
												</button>
										</div>
										<div class="modal-body modal-body-pdf">
											<p>Si le PDF ne s\'affiche pas : . 
													<a href="'.$Y[1].'" class="telecharger-pdf">'.$Y[1].'</a> 
												</p>
												<object data="$1" type="application/pdf" width="100%" height="'.$this->params->get('largeur').'" data-mce-object="object">
												<embed src="'.$Y[1].'" type="application/pdf" style="width:100%;height:300%"></embed>
												
											</object>
										</div>
										
									</div>
								</div>
							</div>';
				
					$article->text = str_replace($Y[0], $subst, $article->text);
			$i++;
			}
			
			
		}	
	}
