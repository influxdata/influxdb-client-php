<?php
# The MIT License
#
# Permission is hereby granted, free of charge, to any person obtaining a copy
# of this software and associated documentation files (the "Software"), to deal
# in the Software without restriction, including without limitation the rights
# to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
# copies of the Software, and to permit persons to whom the Software is
# furnished to do so, subject to the following conditions:
#
# The above copyright notice and this permission notice shall be included in
# all copies or substantial portions of the Software.
#
# THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
# IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
# FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
# AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
# LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
# OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
# THE SOFTWARE.
namespace InfluxDB2;

/**
 * This class represents the table structure of the Flux CSV Response.
 * @link  http://bit.ly/flux-spec#table
 */
class FluxTable
{
    /* @var $variable FluxColumn[]  */
    public $columns;
    /* @var $variable FluxRecord[]  */
    public $records;

    /**
     * FluxTable constructor.
     */
    public function __construct()
    {
        $this->records = [];
        $this->columns = [];
    }

    public function getGroupKey()
    {
        return array_values(array_filter($this->columns, function ($column) {
            return $column->group;
        }));
    }
}
