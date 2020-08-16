User
	- id
	- name
	- email
	- email_verified_at
	- password
	- contact_num
	- role (user | editor | admin)
	- avatar
	- verify_token
	- remember_token
	- plan_id
	- hash
	- slug
	- status

Plan
	- id
	- name
	- plan_identifier
	- limit_list
	- limit_space
	- price
	- hash
	- slug

Listing
	- id
	- name
	- user_id
	- editor_id
	- status (pending | in-progress | completed)
	- hash
	- slug

Item
	- id
	- label
	- descriptions
	- type (img | video)
	- status (raw | edited)
	- listing_id
	- user_id
	- editor_id
	- hash
	- slug