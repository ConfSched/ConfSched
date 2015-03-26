<div data-ng-app="testapp">

<div ng-controller="AuthorPapersController">
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
		<form method="GET">
			<select name="paperid" id="paper_filter" ng-model="form.paperid" ng-options="paper.paperid as paper.title for paper in papers" class="form-control" ng-change="refresh()">
			</select>
		</form>
	</div>
</div>

<br>

<div class="row" ng-controller="PapersController">
	<!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<p>No papers to provide feedback on</p>
	</div> -->
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" ng-repeat="paper in papers | orderBy:'moved_to_bottom_at'">
		<h4>{{ paper.title }}</h4>
		<p><strong>Abstract:</strong> {{paper.abstract}}</p>
		<!-- <p><strong>Moved to bottom at:</strong> {{paper.moved_to_bottom_at}}</p> -->
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<p><button class="show-author-feedback btn btn-lg btn-block btn-primary" ng-click="toggle(paper)">{{ paper.toggleText }}</button></p>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<p><button class="move-to-bottom btn btn-lg btn-block btn-danger" ng-click="moveToBottom(paper)">Move to Bottom</button></p>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<form class="form author-feedback animate-show" ng-show="paper.edit" ng-model="paper">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
							<label for="interest">Would you be interested in attending the session for this paper?</label>
							<div class="radio">
								<label>
									<input type="radio" name="interest" id="interest1" value="1" ng-model="paper.interest">
									Yes
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="interest" id="interest2" value="2" ng-model="paper.interest">
									No
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="interest" id="interest3" value="3" ng-model="paper.interest">
									No Opinion
								</label>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
							<label for="relevant">Is this paper relevant to your paper?</label>
							<div class="radio">
								<label>
									<input type="radio" name="relevant" id="relevant1" value="1" ng-model="paper.relevant">
									Yes
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="relevant" id="relevant2" value="2" ng-model="paper.relevant">
									No
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="relevant" id="relevant3" value="3" ng-model="paper.relevant">
									No Opinion
								</label>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<button type="submit" class="btn btn-lg btn-block btn-primary" ng-click="provideFeedback(paper)">Provide Feedback</button>
						</div>
					</div>
				</form>
				<hr>
			</div>
		</div>
	</div>
</div>
</div>
</div>
