# Laravel Blog v 1.0.0

This basic project was created with Laravel 5.7 for a blog.

Author: Alex Neverov

The project is featured with:

- Laravel 5.7
- Bootstrap 4
- tinyMCE 4
- select2
- laravelcollective/html
- investigation/image
- mews/purifier

## Main features

The blog provides following functionality:

v. 1.0.0
- Posts management;
- Categories and tags management;
- Users management;
- Contact form and Answers management.

## Posts, categories, tag, and commentaries management

v. 1.0.0
- The authorized users having appropriate permissions can create, modify and delete posts.
- Each post can be linked with many categories and many tags.
- Each post can have a featured image which can be uploaded and replaced.
- Each post can have a number of commentaries.
- Each commentary must be approved by users having appropriate permissions before its publication.
- Post's commentaries have hierarchical structure.
- Posts may be commented by authorized users only.
- The users having appropriate permissions can create any number of categories and tags.
- The users can view through the whole list of posts, every single post, and all posts with a given category.

v. 1.0.0-1

The relationship between posts and users is added:

- Each post has an owner which should be an authorized user. The owner is defined when the post have been created and can not be changed.
- If the owner's account were deleted, his/her posts will have no owner.
- The owners can edit and delete their posts.
- The users can just view the post which are not owned by them.
- The administrators can edit and delete any post.

## User management

v. 1.0.0
- Any unauthorized user may see the content of the blog.
- The users may register on the blog freely.
- All registered users get, by default, the lowest access level which allows them to comment posts and commentaries. Their commentaries must be approved before the publication.
- The administrators of the blog may change the access level of any user.
- There are two advanced access levels: authors and administrators.
- The authors may manage the content of the blog: posts, categories, tags, and comments.
- The administrators may manage the content of the blog and the accounts of other users. In addition, they may manage the messages received from the contact form.

## Contact form and Answers management

v. 1.0.0
- Any user may sent a message to the administrator of the blog using a contact form.
- The message is sent via email and saved in the database of the blog.
- The administrators can use a management panel to read, answer and delete messages.
- The answers are sent via email to the author of the message.
