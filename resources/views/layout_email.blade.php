  <table cellpadding="0"  width="100%" cellspacing="0" border="0" id="backgroundTable" class='bgBody'>
		<tr>
			<td>

				<!-- Tables are the most common way to format your email consistently. Set your table widths inside cells and in most cases reset cellpadding, cellspacing, and border to zero. Use nested tables as a way to space effectively in your message. -->

				<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%" style="border-collapse:collapse;">
					<tr>
						<td class='movableContentContainer'>

							<div class='movableContent'>
								<table cellpadding="0" cellspacing="0" border="0" align="center" width="600">
									<tr height="40">
										<td width="200">&nbsp;</td>
										<td width="200">&nbsp;</td>
										<td width="200">&nbsp;</td>
									</tr>
									<tr>
										<td width="200" valign="top">&nbsp;</td>
										<td width="200" valign="top" align="center">
											<div class="contentEditableContainer contentTextEditable">
												<div class="contentEditable" >
													<img src="{{ asset('images/logo.png') }}" width="155" height='155' alt='Logo'  data-default="placeholder" />
												</div>
											</div>
										</td>
										<td width="200" valign="top">&nbsp;</td>
									</tr>
									<tr height="25">
										<td width="200">&nbsp;</td>
										<td width="200">&nbsp;</td>
										<td width="200">&nbsp;</td>
									</tr>
								</table>
							</div>

				<div class='movableContent'>
          @section('content')
          @show
				</div>
	</table>
<!-- END BODY -->

			</td>
		</tr>
	</table>
