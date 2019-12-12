class Node {
	constructor(element) {
		this.element = element;
		this.next = null;
	}
}
class LinkedList {
	constructor() {
		this.head = null;
		this.size = 0;
	}
	add(element) {
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

$.ajax({
	type: "GET",
	url: "../../web/get.php",
	success: function(data){
		console.log(data);
	}
});
//var passedArray = <?php echo json_encode($dressArray); ?>;
//var arrayLength = passedArray.length;
//for (var i = 0; i < arrayLength; i++) {
//	dressList.add(passedArray[i]);
//	console.log("Dress: "+passedArray[i]);
//}
function addList(){
	for (var i = 0; i < arrayLength; i++) {
	dressList.add(passedArray[i]);
	console.log("Dress: "+passedArray[i]);
	}
}
var curr = dressList.head;

	if(curr == null){
		console.log("Something went wrong");
		dressList.add("https://realdress.s3-us-west-1.amazonaws.com/user_uploads/dress1S.png");
		dressList.add("https://realdress.s3-us-west-1.amazonaws.com/user_uploads/dress2S.png");
		dressList.add("https://realdress.s3-us-west-1.amazonaws.com/user_uploads/dress3.png");
		
		var curr = dressList.head;
	}


function changeDress() {
		document.getElementById("clothes").style.backgroundImage = "url(" + curr.element + ")";
		if (curr.next != null) {
			curr = curr.next;
		} else {
			curr = dressList.head;
		}
}