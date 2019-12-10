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
		
		var passedArray = <?php echo json_encode($dressArray); ?>
		passedArray.forEach(arrayAdd);
		function arrayAdd(dress)
		{
			dressList.add(dress);
		}
		//dressList.add("/assets/img/dress1.png");
		//dressList.add("/assets/img/dress2.png");
		//dressList.add("/assets/img/dress3.png");

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
		