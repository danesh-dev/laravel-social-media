namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Post;

class Post extends Component
{
    public Post $post;

    /**
     * Create a new component instance.
     *
     * @param Post $post
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.post');
    }
}
