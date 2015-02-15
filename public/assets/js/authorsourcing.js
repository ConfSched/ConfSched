var authorSourcingApp = angular.module('testapp', []); 



authorSourcingApp.controller('AuthorPapersController', function($scope, $http) {
	$http({
		method: 'GET',
		url: get_author_papers_url
	}).success(function(data, status) {
		//console.log(data);
		//console.log(status);
		$scope.papers = angular.fromJson(data);
		$scope.form = { 'paperid': $scope.papers[0].paperid };
		//console.log($scope.form);
		$scope.$broadcast('refreshPaper', {'paperid' : $scope.form.paperid });
	}).error(function(data, status) {
		//console.log(data);
		//console.log(status);
		alert('Something went wrong.');
	});

	$scope.refresh = function() {
		//console.log($scope.form.paperid);
		$scope.$broadcast('refreshPaper', {'paperid' : $scope.form.paperid });
	}
});

authorSourcingApp.controller('PapersController', function($scope, $http) {
	$scope.$on('refreshPaper', function(event, args) {
		//console.log('refresh');
		//console.log(args);
		$http({
			method: 'GET',
			url: get_papers_url + '/' + args.paperid
		}).success(function(data, status) {
			//console.log(data);
			//console.log(status);
			//console.log(angular.fromJson(data));
			$scope.papers = angular.fromJson(data);
			angular.forEach($scope.papers, function(paper) {
				paper.toggleText = 'Provide Feedback';
				paper.otherid = args.paperid;
				paper.moved_to_bottom_at = '';
			});
			angular.forEach($scope.papers, function(paper) {
				$http({
					method: 'GET',
					url: get_feedback_url + '/' + paper.paperid + '/' + args.paperid + '/' + userid
				}).success(function(data, status) {
					//console.log(data);
					//console.log(status);
					if (status == 200) {
						paper.feedback = angular.fromJson(data);
						//console.log(paper.feedback.moved_to_bottom_at);
						//console.log(paper.feedback.moved_to_bottom_at != null);
						paper.hasfeedback = false;
						
						if (paper.feedback.relevant != null) {
							paper.hasfeedback = true;
							paper.relevant = paper.feedback.relevant;
						}

						if (paper.feedback.interest != null) {
							paper.hasfeedback = true;
							paper.interest = paper.feedback.interest;
						}

						if (paper.hasfeedback) {
							paper.toggleText = 'Edit Feedback';
						}

						if (paper.feedback.moved_to_bottom_at != null) {
							//console.log(paper.feedback.moved_to_bottom_at.date);
							paper.moved_to_bottom_at = paper.feedback.moved_to_bottom_at;
							//console.log(paper.moved_to_bottom_at);
						}
						else {
							paper.moved_to_bottom_at = '';
						}
						
						//console.log(angular.fromJson(data));
					}
					else {
						paper.feedback = undefined;
						paper.moved_to_bottom_at = '';
					}
				}).error(function(data, status) {
					//console.log(data);
					//console.log(status);
					//console.log("we've got a turd in the punch bowl.");
					paper.feedback = undefined;
					paper.moved_to_bottom_at = '';
				});
			});
			//console.log($scope.papers.length);
		}).error(function(data, status) {
			//console.log(data);
			//console.log(status);
			alert('Something went wrong.');
		});
	});

	$scope.toggleText = 'Provide Feedback';
	$scope.toggle = function(paper) {
		paper.edit = ! paper.edit;
		if (paper.hasfeedback) {
			paper.toggleText = paper.edit ? 'Collapse' : 'Edit Feedback';
		}
		else {
			paper.toggleText = paper.edit ? 'Collapse' : 'Provide Feedback';
		}
	}
	$scope.moveToBottom = function(paper) {
		paper.moved_to_bottom_at = new Date;
		//console.log(paper);
		//console.log(paper.feedback[0].id);
		//console.log((new Date));
		//console.log(paper.moved_to_bottom_at);
		//console.log(typeof paper.feedback);
		if (typeof paper.feedback != 'undefined') {
			$http({
				method: 'PUT',
				url: put_feedback_url + '/' + paper.feedback.id,
				data: {'paper1': paper.paperid, 'paper2': paper.otherid, 'relevant': paper.relevant, 'interest': paper.interest, 'userid': userid, 'moved_to_bottom_at': paper.moved_to_bottom_at}
			}).success(function(data) {
				paper.feedback = angular.fromJson(data);
				console.log(paper.feedback);
				paper.moved_to_bottom_at = paper.feedback.moved_to_bottom_at.date;
			}).error(function() {
				alert('Something went wrong.');
			});
		}
		else {
			console.log('feedback does not exist yet.');
			$http({
				method: 'POST',
				url: post_feedback_url,
				data: {'paper1': paper.paperid, 'paper2': paper.otherid, 'relevant': paper.relevant, 'interest': paper.interest, 'userid': userid, 'moved_to_bottom_at': paper.moved_to_bottom_at}
			}).success(function(data, status) {
				//console.log(data);
				//console.log(status);
				paper.feedback = angular.fromJson(data);
				//console.log(paper.feedback);
				paper.moved_to_bottom_at = paper.feedback.moved_to_bottom_at.date;
			}).error(function(data, status) {
				//console.log(data);
				//console.log(status);
			});
		}
		
	}
	$scope.provideFeedback = function(paper) {
		if (paper.feedback != null && typeof paper.feedback.id != 'undefined') {
			console.log('existing');
			$http({
				method: "PUT",
				url: put_feedback_url + '/' + paper.feedback.id,
				data: {'paper1': paper.paperid, 'paper2': paper.otherid, 'relevant': paper.relevant, 'interest': paper.interest, 'userid': userid }
			}).success(function(data, stats) {
				paper.feedback = angular.fromJson(data);
				paper.hasfeedback = true;
				paper.edit = false;
				paper.toggleText = 'Edit Feedback';
				// if (paper.hasfeedback) {
				// 	paper.toggleText = 'Edit Feedback';
				// }
			}).error(function(data,status) {
				console.log("we've got a turd in the punch bowl.");
			});
		}
		else {
			console.log('new');
			$http({
				method: 'POST',
				url: post_feedback_url,
				data: {'paper1': paper.paperid, 'paper2': paper.otherid, 'relevant': paper.relevant, 'interest': paper.interest, 'userid': userid }
			}).success(function(data, status) {
				paper.feedback = angular.fromJson(data);
				paper.hasfeedback = true;
				paper.edit = false;
				paper.toggleText = 'Edit Feedback';
				// if (paper.hasfeedback) {
				// 	paper.toggleText = 'Edit Feedback';
				// }
			}).error(function(data, status) {
				console.log("we've got a turd in the punch bowl");
			});
		}
		
	}
});