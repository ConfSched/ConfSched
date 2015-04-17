# User Guide

## Admin

### Introduction

The flow of the software is as follows:

1. Initialization
2. Start Preplanning
3. Preplanning
4. End Preplanning
5. Start Committee Sourcing/ Author Sourcing
6. Committee Sourcing / Author Sourcing
7. End Committee Sourcing / Author Sourcing
8. Start Scheduling
9. Scheduling

### Initialization

A wizard will guide you through the initialization process. Here you will enter basic information such as conference name and set up your admin account.

### Dashboard

Once you login to ConfSched, you will see your dashboard. This will show you all your current, upcoming, and completed tasks. This will guide you through the workflow of the process.

### Preplanning

See the [chair's guide](http://www.openconf.com/documentation/chair.php) to OpenConf.

After you are all done with the preplanning phase, you can go to the ConfSched dashboard and choose the "Finalize Preplanning" option under current tasks. This will send out emails to the Committee Members and Authors allowing them to register for the ConfSched site. You will also be presented with the options to start the Committee Sourcing and Author Sourcing phases.

### Committee Sourcing

Once you select the "Start Committee Sourcing" button, you will start the Committee Sourcing phase. This will send an email to all committee members to alert them that they can now partake in the Committee Sourcing phase. Once you are ready to finish the Committee Sourcing phase, return to your dashboard and select the "Finalize Committee Sourcing" option.

### Author Sourcing

Once you select the "Start Author Sourcing" button, you will start the Author Sroucing phase. This will send an email to all committee members to alert them that they can now partake in the Author Sourcing phase. Once you are ready to finish the Author Sourcing phase, return to your dashboard and select the "Finalize Committee Sourcing" option.

### Scheduling

Once the Committee Sourcing and Author Sourcing phases are complete, you will be given the option to start the scheduling phase. Once you start the scheduling phase, you will see a scheduling menu. This will guide you through the scheduling process.

#### Rooms

The first step is to add the room information. To add the rooms, you will need a CSV file containing all the room information. Room information includes room, capacity, and whether or not the room can have special equipment. 

An example of a properly formatted CSV file is:

```
Room,Capacity,Equipment
Trexler 363,30,true
Trexler 263,25,false
Olin 120,20,false
Trexler 372,30,false
IT Closet,4,false
```
If you need to update the rooms, you should update your CSV file first and then re-upload. When re-uploading your CSV file, none of the existing information will be kept.

#### Sessions

Once you have all the rooms set up, you may start creating the sessions. A session has a start datetime, end datetime, number of papers, and a room.

#### Constraints

You may also supply some basic constraints during this phase. You should do this after you setup the sessions. Here, you may specify that an author isn't available for a certain session. You may also map author accounts together. This is useful when an author registered using different email accounts during the preplanning phase. This wasn't a problem up until this point, the author just had multiple accounts. You'll need to fix this before generating the schedule or you'll possibly run into the problem of an author being double booked.

#### Generate

Once you have set up the rooms, sessions, and finished with all constraints, you may generate the schedule. You can hit generate and it will run the generation process. You'll get back multiple schedules to choose from. The results page will give you a dropdown to select the different schedules. For each schedule, you will see the number of conflicts that schedule has. You may also manually swap papers in a schedule.

## User

### Introduction

Welcome, this will help guide you through your interactions with the ConfSched web application.

### Preplanning

### Committee Sourcing

### Author Sourcing

### Scheduling

## User

### Introduction

The user's have 3 phases to care about:

1. Preplanning
2. Committee Sourcing
3. Author Sourcing

### Preplanning

Preplanning users fit into 2 categories:

1. Authors
2. Committee Members

#### Authors

Authors can submit papers for reviewal, edit paper submissions, upload files, and withdraw papers for reviewal.

##### Submit Paper

Authors can submit papers for review during the preplanning stage. To submit a paper for reviewal, navigate to the OpenConf index page. From there, choose the "Make Submission" option. This will present you with a form to enter information about your paper. You will choose a password for the submission. This password can be used to edit your submission. When finished, press the "Make Submission" button. This will bring you to a confirmation page. You will also receive an email containing information about your submission. You will have a 2 hour window to make updates to your submission.

##### Edit Paper

Authors may edit their submission up to 2 hours after submitting. To edit a submission, you will need your submission id and password. Entering your submission id and password will take you to a form to edit the information for the submission.

##### Add File to Submission

Authors may add a file to a submission. To do so, you will need your submission id and password. Select the "File Upload" option from the main menu. You will be prompted for your submission id and password and what file to upload and what format. The formats will be set by the admin of the conference.

##### Withdraw Paper

Authors may withdraw their submission. To do so, select "Withdraw Submission" from the main menu. Enter the submission id and the password of the submission you want to withdraw and press the "Withdraw Submission" button.

#### Committee Members

Committee Members can review papers.

###### Review Papers

To review papers, login from the OpenConf index page. This will take you to a screen that lists your papers to review. From there, select a paper to review it.

### Dashboard

Following the preplanning process, emails will be sent out to Committee Members and Authors of accepted papers to register an account with ConfSched. Use the link in the email to create your account. From there, you may log in. 

Upon logging in, you will see your dashboard. This is the central hub for everything. You will see your current tasks, upcoming tasks, and your completed tasks. When a task is current, you can click on the button for the task in your dashboard to take you to the page to complete the task.

A task will remain as current until the admin ends the phase. So don't be concerned if you have completed all your possible tasks for the current phase but it still remains on your dashboard. This doesn't mean you have uncompleted tasks. This just means the admin has yet to end the current phase.

### Committee Sourcing

Committee Members may provide their feedback after all the papers have been accepted in the Committee Sourcing phase. In this phase, Committee Members will see all papers for their topics. They can create categories and group similar papers together. This will provide some data that can be used in the scheduling process to create better schedules.

When this phase opens, Committee Members will receive an email alerting them that the Committee Sourcing phase is open. Committee Members can navigate to their ConfSched dashboard and they will see the Committee Sourcing task. They may click on the task to take them to the page to complete the task.

Once on the Committee Sourcing page, you will see a dropdown containing all your topics. Changing this dropdown will refresh the page and show you the accepted papers for the chosen topic.

On the far left, you will see all the accepted papers for the topic. On the right, you will see your categories for the topic. Initially, there won't be any there. In the top right corner, you'll see a button to add a category. Use this to create categories.

To add a paper to a category, click on the paper. This will take you to a screen with a dropdown of all your categories for the topic. You can select which category you want to add the paper to.

To remove a paper from a category, click on the red x in the right corner of the paper in the paper list in the category. This will remove the paper from the category.

To remove a category, click the red x in the upper right hand corner of the category.

### Author Sourcing

Authors (that have at least one paper accepted) can provide their feedback on other accepted papers with the same topic as their paper(s). This data can be used to create better schedules.

When this phase opens, authors will receive an email alerting them that the Author Sourcing phase is open. Authors can navigate to their ConfSched dashboard and they will see the Author Sourcing task. They may click on the task to take them to the page to complete the task.

Once on the Author Sourcing page, authors will see a dropdown containing their accepted papers. Authors may change which paper they are providing feedback on by changing the value of this dropdown.

The other accepted papers with the same topic as the author's currently selected paper will be shown. For each paper, there are two buttons. One is Provide / Edit Feedback. The other is Move to Bottom. 

The Move to Bottom button will move the paper to the bottom of the list. This is useful if you don't want to provide feedback on a paper and want it out of the way. This won't hide the paper so you can always scroll down to find it again.

The Provide Feedback button will show you a form to provide feedback for a paper. You will see Provide Feedback if you have not yet provided feedback for the paper.

The Edit Feedback button will show you a form with your previously entered feedback for the paper. You Will see Edit Feedback if you have already provided feedback for the paper. You may edit your previous entry.
