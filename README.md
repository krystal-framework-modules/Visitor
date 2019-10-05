
Visitor
======

Simple module to manage visitors (also known as Guests).

# Usage

Whenever someone's profile is viewed, you just need to track corresponding IDs of currently logged in user and viewed one. You can use the following method:

`\Visitor\Service\VisitorService::visit($ownerId, $visitorId)`

Later on, you can view all users who visited a profile by running `/profile/visitors` in a browser. The default view template is used to render presentation.