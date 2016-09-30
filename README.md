Student Archive
=====================

Current Requirements
----------------------
+ Create search bar to search database
	+ Organized in a hierarchy of:
		+ Class
			+ Teacher
				+ Semester
					+ Document
						+ Document has associated attribute "type" that describes whether it's an exam, video, etc.
+ Create system to display search results dynamically
+ Create uploading system
+ Create flagging system
+ Create polling system

Members:
------------
Max Burns

Hari Murali

Andrew Hessler

Jusuf Skelic

Usage:
-----------
The "Student Archive" is a centralized place where students of IIT (Illinois Institute of Technology) can upload materials from classes, whether that be handouts, exams, quizzes, homework or even videos. Our job is to lay the foundation from which other students can build and to design the framework for supporting the upload and deletion of documents by community polling.

The site has three types of users: *Explorers*, *Contributors* and *Power-Contributors*.

###Explorers:
Explorers will likely be the larger userbase out of the three and will be the ones downloading documents for consumption. Their average interaction with the site should look as follows:

1. "I need CS487 past exams to help study"
2. Click on search bar, type 'CS487', 'CS 487', '487', 'Software Engineering', or any substring of those which populates a list on the site.
3. The student is only interested in exams, so they can select a checkbox from the right side of the screen that allows them to filter for different categories, such as 'handouts', 'exams', 'quizzes' and so on.
4. As the student is typing, the list is dynamically populating with related materials, so they may stop short because they see what they want, or type it all the way out to make their search more specific. In the end, they will have a list of exams from CS 487 separated by instructor and then further separated by semester (*Explorers* will have the option to remove the structuring and just get purely materials listed).
5. Clicking on the name of a document will start the download, alternatively they can batch download by checking boxes next to the materials they want and clicking a button that says "Batch Download".

###Contributors
*Contributors'* main duty will be to provide materials that the site will display. A typical interaction of a *Contributor* with the site will be:

1. Click "Upload" button.
2. Browse for the file they want to upload on their computer.
3. Name the file in a "Title" box.
4. Pick the class it belongs to from a dropdown list with searching capabilities.
5. Pick the teacher it belongs to from a dropdown list with searching capabilities.
6. Pick the semester it belongs to from a dropdown of existing semesters.
7. Lastly, hit upload.

There is no special permission required to be a *Contributor*, anyone is allowed to contribute and will be able to upload once they have verified their iit.edu email. Their name will be linked to their contribution to uphold integrity so that if any user attempts to flood the site with bogus information, it will be known who it is. While this i the main reasoning for providing a name with a contribution, it also encourages people to contribute because they will be known as helpful people around campus, which could benefit them in the future.

###Power-Contributors:
Last are *Power-Contributors*, these are users who add to the functionality of the site and improve it in someway beyond providing documents. They will not have an average interaction with the site, but their average interatcion with us will be as follows:
1. Provide code to github with an improvement for the site.
2. Provide an explanation of what their code does and how it improves the site.

If the code is useful we will merge it into the site. Hopefully, if this consistently used around campus, it is something that they could potentially put on their resume, which would be a major incentive for being a *Power-Contributor*.
