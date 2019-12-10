	  class Node {
		constructor(element)
		{
			this.element = element;
			this.next = null;
		}
	  }
	  class LinkedList{
		constructor()
		{
			this.head = null;
			this.size = 0;
		}
		add(element)
		{
			var node = new Node(element);
			var current;
			if (this.head == null) 
				this.head = node; 
			else { 
				current = this.head;  
				while (current.next) { 
					current = current.next; 
				} 
				current.next = node; 
			} 
			this.size++;
		} 
	  }
	  
		var dressList = new LinkedList();
		console.log("dresslist created");
		var current = dressList.head;  
				while (current.next) { 
					console.log(current.element);
					current = current.next; 
				} 
	
		//dressList.add("https://realdress.s3-us-west-1.amazonaws.com/user_uploads/dress1S.png");
		//dressList.add("https://realdress.s3-us-west-1.amazonaws.com/user_uploads/dress2S.png");
		//dressList.add("https://realdress.s3-us-west-1.amazonaws.com/user_uploads/dress3.png");

		var curr = dressList.head;
		function changeDress()
		{
			document.getElementById("clothes").style.backgroundImage = "url(" + curr.element + ")";
				if(curr.next != null){
				curr = curr.next;
				} else {
				curr = dressList.head;
				}	
		}
		