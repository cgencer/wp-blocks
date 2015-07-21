	<script type="text/x-handlebars" data-template-name="todos">
		<section id="todoapp">
			<header id="header">
				<h1>todos</h1>
				{{view Ember.TextField id="new-todo" placeholder="What needs to be done?" valueBinding="newTitle" action="createTodo"}}
			</header>

			{{#if length}}
			<section id="main">
				<ul id="todo-list">
				{{#each filteredTodos itemController="todo"}}
					<li {{bindAttr class="isCompleted:completed isEditing:editing"}}>
					{{#if isEditing}}
						{{view Todos.EditTodoView todoBinding="this"}}
					{{else}}
						{{view Ember.Checkbox checkedBinding="isCompleted" class="toggle"}}
						<label {{action "editTodo" on="doubleClick"}}>{{title}}</label>
						<button {{action "removeTodo"}} class="destroy"></button>
					{{/if}}
					</li>
				{{/each}}
				</ul>
				{{view Ember.Checkbox id="toggle-all" checkedBinding="allAreDone"}}
			</section>

			<footer id="footer">
				<span id="todo-count">{{{remainingFormatted}}}</span>
				<ul id="filters">
					<li>
						{{#linkTo todos.index activeClass="selected"}}All{{/linkTo}}
					</li>
					<li>
						{{#linkTo todos.active activeClass="selected"}}Active{{/linkTo}}
					</li>
					<li>
						{{#linkTo todos.completed activeClass="selected"}}Completed{{/linkTo}}
					</li>
				</ul>

				{{#if hasCompleted}}
				<button id="clear-completed" {{action "clearCompleted"}} {{bindAttr class="buttonClass:hidden"}}>
						Clear completed ({{completed}})
				</button>
				{{/if}}
			</footer>
			{{/if}}
		</section>
		<footer id="info">
			<p>Double-click to edit a todo</p>
			<p>
				Created by
				<a href="http://github.com/tomdale">Tom Dale</a>,
				<a href="http://github.com/addyosmani">Addy Osmani</a>,
				and <a href="http://github.com/stephenplusplus">Stephen Sawchuk
			</p>
			<p>Part of <a href="http://todomvc.com">TodoMVC</a></p>
		</footer>
	</script>