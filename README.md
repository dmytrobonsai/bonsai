Welcome to the Bonsai Magento Challenge!

Bonsai is a mobile application and technology company. We’re interested in how content inspires action. By personalizing delivery of the world’s leading content, we enable the discovery of products or experiences that make your life better, cooler and more interesting. As a venture-backed startup that’s raised $6M to date (on-track to raise a $20M Series A), we work with leading media companies and retailers to prove the content-commerce thesis.

We are looking for intermediate/senior php developers that can hit the ground running building full-features for an open-source e-commerce project. This environment simulates the work as closely as possible, so that's great news if you can navigate your way around this stack.

Good luck!

# Challenge
This is an open ended challenge. You can implement whatever you want.
For example:
- Custom payment method
- Custom shipping method
- Create a new style template and use it

# Prerequisites

1. docker-desktop (Mac & Windows)
2. Make sure Docker has 4GB of RAM available. Click docker-desktop->preferences->advanced move slider to 4GB

# Running the project

- In the root project: run `docker-compose up` (This will take a several minutes)
- Go to a browser and open `http://localhost`

# (If needed) Admin Panel Credentials

- admin panel: `http://localhost/admin`
- admin user: `admin`
- admin password `admin123`

# (If needed) Database Access

- Download your favourite SQL database software
- dbname: `magento`
- username: `root`
- password: `password`


# Magento slider extension for Bonsai hackathon

This extension allow users to add many sliders on any page using simple block.

It uses Slick JS slider with various types of animation, sliders position, visible by store for multi store websites, and much more.

How to manage banners:
- Please go to Admin panel > Content > Banners
- Create new banner by clicking on "Add New Banners" button
- Type the name of the banner and create a new banner element in the wysiwyg editor, you can use html or simple image.

How to manage sliders:
- Please go to Admin panel > Content > Sliders
- Create a new banner by clicking on "Add New Slider" button
- Fill form fields and choose proper options based on your needs
- On the left side Banners tab you can choose banners which should be showed in the current slider

How to display slider on cms pages:
- Please go to the Admin Panel > Content > Pages and choose page which you would like to edit
- Place this shortcut in content section `{{block class="Bonsai\Slider\Block\Slider" template="Bonsai_Slider::slider.phtml" slider_id="1"}}` where slider_id should equal to the slider id from Admin panel > Content > Sliders
- If you would like to use in in your theme - you should place this block based on your layout file (this step is more for developers): 
`<block class="Bonsai\Slider\Block\Slider" name="bonsai_slider" template="Bonsai_Slider::slider.phtml" slider_id="1" />`

More settings for slider effects and other improvements coming soon